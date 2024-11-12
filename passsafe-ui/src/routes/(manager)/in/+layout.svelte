<script lang="ts">
    let whref = window.location.pathname;
</script>
  

<header>
</header>

<main class="layout-in">
    <slot></slot>
</main>

<footer class="footer-in">
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