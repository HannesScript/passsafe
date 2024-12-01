<script>
    // The modal is always open once it's in the DOM
</script>

<div class="modal">
    <div class="modal-content">
        <input type="text" placeholder="Service" class="service">
        <input type="text" placeholder="Username" class="username">
        <input type="password" placeholder="Password" class="password">
        <div><button class="btn">Create</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-cancel">Cancel</button></div>
    </div>
</div>

<style>
    .modal {
        display: block; /* Always display the modal */
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 100dvw;
        height: 100dvh;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4); /* Black background with opacity */
        z-index: 999;
    }

    .modal-content {
        background-color: #fff;
        margin: 15% auto; /* Center the modal content */
        padding: 20px;
        border: 1px solid #888;
        width: 60%;
        z-index: 1000;
        border-radius: 1rem;
        min-height: 5rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }


    .service {
        border: none;
        font-size: 5rem;
        color: #555;
    }

    .service:focus {
        outline: none;
    }

    input {
        max-width: 50%;
        padding: 1rem;
        border-radius: 1rem;
        border: 1px solid #ccc;
    }

    .btn {
        padding: 1rem;
        border-radius: 1rem;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        max-width: min-content;
    }

    .btn-cancel {
        background-color: #797979;
    }
</style>