<script lang="ts">
	import Sidelist from "$lib/pws/sidelist.svelte";
	import { Moon } from 'svelte-loading-spinners';
	import { invoke } from "@tauri-apps/api/core";

	let isOpenPwViewer = false;
	let pwData: any = {};
	let loading: boolean = false;
	let loadingStatus: string = "Fetching data...";

	const openPW = (data: object) => {
		pwData = data;
		isOpenPwViewer = true;
		loading = true;

		loadingStatus = "Fetching data...";
		setTimeout(() => {
			loadingStatus = "Decrypting data...";
		}, 1000);
		setTimeout(() => {
			loadingStatus = "Almost done...";
		}, 3000);
		setTimeout(() => {
			loading = false;
		}, 4000);

		decryptPW(pwData.password);
	};

	const closePW = () => {
		isOpenPwViewer = false;
	};

	const decryptPW = async (password: string) => {
		const decrypted = await invoke("decrypt_pw", {
			pw: pwData.password,
		});

		pwData.password = decrypted;
		loading = false;
	};
</script>

<div class="main-pws">
	<Sidelist {openPW} />
	<div class={"main-pws-content" + (isOpenPwViewer ? " active" : "")}>
		<h1>{pwData.name}</h1>
		{#if loading}
			<div style="height: 80%; width: 95%; display: flex; justify-content: center; align-items: center; flex-direction: column;">
				<h3>{loadingStatus}</h3>
				<Moon size="8" color="#45A049" unit="rem" duration="1s" />
			</div>
		{:else}
			<p>Username: {pwData.username}</p>
			<p>Password: {pwData.password}</p>
		{/if}
	</div>
</div>

<style>
	.main-pws {
		display: flex;
		height: 90dvh;
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
	}

	.Sidelist {
		flex: 1;
	}

	.main-pws-content {
		transition: flex 1s;
		flex: -2;
		width: 0;
		padding-left: 3rem;
		overflow-x: hidden;
		/* Scrollable */
		overflow-y: scroll;
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