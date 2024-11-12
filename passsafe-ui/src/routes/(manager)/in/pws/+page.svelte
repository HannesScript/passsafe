<script>
	import Sidelist from "$lib/pws/sidelist.svelte";
	import { onMount } from "svelte";
	let isOpenPwViewer = false;

	onMount(() => {
		console.log("mounted");
		setTimeout(() => {
			isOpenPwViewer = true;
		}, 1000);
	});
</script>

<div class="main-pws">
	<Sidelist />
	<div class={"main-pws-content" + (isOpenPwViewer ? " active" : "")}>
		<h1>Password!</h1>
	</div>
</div>

<style>
	.main-pws {
		display: flex;
		height: 100vh;
	}

	.Sidelist {
		flex: 1;
	}

	.main-pws-content {
		transition: flex 1s;
		flex: -2;
		width: 0;
		padding-left: 3rem;
	}

	.main-pws-content * {
		display: none;
		transition: opacity 1s;
		opacity: 0;
	}

	.main-pws-content.active {
		flex: 7;
	}

	.main-pws-content.active * {
		display: block;
		opacity: 1;
	}
</style>