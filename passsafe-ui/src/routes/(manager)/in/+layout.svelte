<script lang="ts">
    let whref = window.location.pathname;
</script>
  

<header>
</header>

<main>
    <slot></slot>
</main>

<footer>
    <a href="/in/pws" class={whref == "/in/pws" ? "selected" : ""}>
        <span class="material-symbols-outlined">
            key
        </span>
        <span>Passwords</span>
    </a>
    <a href="/in/acc" class={whref == "/in/acc" ? "selected" : ""}>
        <span class="material-symbols-outlined">
            person
        </span>
        <span>Account</span>
    </a>
</footer>

<style>
    header {
        background-color: #333;
        color: white;
        padding: 1em;
    }

    main {
        padding: 1em;
    }

    footer {
        box-shadow: #0000005d 0px 0px 15px 1px;
        color: white;
        padding: 0;
        position: fixed;
        bottom: 0;
        width: 100dvw;
        height: 8dvh;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 100;
    }

    footer a {
        color: black;
        text-decoration: none;
        font-size: 20px;
        display: flex;
        height: 100%;
        flex-direction: column;
        justify-content: center;
        text-align: center;
        width: 50dvw;
    }

    footer a:hover {
        background-color: rgb(206, 206, 206);
    }
</style>