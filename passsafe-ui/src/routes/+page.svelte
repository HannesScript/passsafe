<script lang="ts">
    import { invoke } from "@tauri-apps/api/core"
    import { goto } from '$app/navigation';
	import { loginUser, registerUser } from "$lib/api";
	import { onMount } from "svelte";

    let isCreatingAccount = false;

    async function createAcc() {
        const email = (document.getElementById('email') as HTMLInputElement).value;
        const password = (document.getElementById('password') as HTMLInputElement).value;
        const passwordRepeat = (document.getElementById('password-repeat') as HTMLInputElement).value;

        if (password !== passwordRepeat) {
            alert('Passwords do not match');
            return;
        }

        const response = await registerUser(email, password);

        const uidstr = await response.text();

        let key: string = await invoke('loginas', { email, password, uid: uidstr });        

        // Store key and UID in local storage
        localStorage.setItem('key', key);
        localStorage.setItem('uid', uidstr);

        if (response.status === 201 || response.status === 200) {
            goto(`/in`, { replaceState: true }) 
        } else {
            alert('An error occurred');
        }
    }

    async function login() {
        const email = (document.getElementById('email') as HTMLInputElement).value;
        const password = (document.getElementById('password') as HTMLInputElement).value;

        const response = await loginUser(email);

        const uidstr = await response.text();
        let key: string = await invoke('loginas', { email, password, uidstr });
        
        // Store key and UID in local storage
        localStorage.setItem('key', key);
        localStorage.setItem('uid', uidstr);

        if (response.status === 200 || response.status === 201) {
            goto(`/in`, { replaceState: true }) 
        } else {
            alert('An error occurred');
        }
    }

    onMount(async () => {
        if(localStorage.getItem('key') && localStorage.getItem('uid')) {
            goto(`/in`, { replaceState: true }) 
        }
    });
</script>

<div class="main-div-login">
    {#if isCreatingAccount}
        <h1>Create an Account</h1>
        <form on:submit|preventDefault={createAcc}>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password-repeat">Repeat Password:</label>
                <input type="password" id="password-repeat" name="password-repeat" required>
            </div>
            <div class="form-group-accept">
                <!-- Checkbox required: I accept that PassSafe can send security notifications to my email -->
                <input type="checkbox" id="accept" name="accept" required><span>I accept that PassSafe can send security notifications to my email</span>
            </div>
            
            <button type="submit" class="btn">Create Account</button>
        </form>
        <p>Already have an account? <button class="change-btn" on:click={() => isCreatingAccount = false}>Login</button></p>
    {:else}
        <h1>Login</h1>
        <form on:submit|preventDefault={login}>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <p>Don't have an account? <button class="change-btn" on:click={() => isCreatingAccount = true}>Create one</button></p>
    {/if}
</div>

<style>
    .main-div-login {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        height: 100vh;
        width: 100vw;
        background-color: #f0f2f5;
    }

    h1 {
        margin-bottom: 20px;
        color: #333;
    }

    form {
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 3px 6px 4px rgba(0,0,0,0.1);
        width: 300px;
        display: flex;
        flex-direction: column;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group-accept {
        margin-bottom: 15px;
        display: flex;
        align-items: flex-start;
    }

    .form-group-accept input {
        margin-right: 10px;
        margin-top: 0.39rem;
        width: min-content;
    }

    label {
        margin-bottom: 5px;
        color: #555;
    }

    input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 100%;
    }

    .btn {
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .btn:hover {
        background-color: #45a049;
    }

    .change-btn {
        color: #4CAF50;
        cursor: pointer;
        border: none;
        padding: 0;
        background-color: transparent;
        font-size: 1rem;
        text-decoration: underline;
    }

    p {
        margin-top: 15px;
    }
</style>