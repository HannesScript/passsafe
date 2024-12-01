<script lang="ts">
	import { getServices } from '$lib/api';
	import getWebsiteIcon from '$lib/getwebsiteicon';
	import { onMount } from 'svelte';
	import Create from './create.svelte';

	export let openPW;

	let pws: Array<any> = [];
	let search = '';
	let creatingPw = false;

	const openPw = (pw: object) => {
		openPW?.(pw);
	};

	const createPw = () => {
		creatingPw = true;
	};

	onMount(async () => {
		await getServices(parseInt(localStorage.getItem('uid')!, 10)).then((r) => (pws = r));

		pws = await Promise.all(
			pws.map(async (pw) => {
				return {
					...pw,
					img: await getWebsiteIcon(pw.url).then((r) => r)
				};
			})
		);
	});
</script>

<div class="main">
	{#if creatingPw}
		<Create></Create>
	{/if}
	<div class="top-bar">
		<input type="text" class="search-input" placeholder="Search" bind:value={search} />
		<div class="right">
			<button class="btn" on:click={createPw}>Create Password</button>
		</div>
	</div>
	{#if pws.length > 0}
		{#each pws.filter((pw) => pw.name.toLowerCase().includes(search.toLowerCase())) as pw}
			<button class="item" on:click={() => openPw(pw)}>
				<img
					src={pw.img ||
						'https://fonts.gstatic.com/s/i/short-term/release/materialsymbolsoutlined/lock/default/48px.svg'}
					alt="Website icon"
					class="website-icon"
				/>
				<h3>{pw.name}</h3>
			</button>
		{/each}
	{:else}
		<h1 style="color: #a6a6a6; text-align: center;">You have no passwords yet...</h1>
	{/if}
</div>

<style>
	.main {
		padding: 1em;
		flex: 1.5;
		min-width: 20dvw;
		display: flex;
		flex-direction: column;
		gap: 2rem;
		height: 90dvh;
		/* Smal black line at the right */
		border-right: 1px solid #00000049;
		/* 6rem margin at the bottom */
		margin-bottom: 8rem;
		/* Scrollable */
		overflow-y: scroll;
	}

	.main .item:hover {
		background-color: #e0e0e0;
	}

	.main .item:active {
		background-color: #d0d0d0;
	}

	.item {
		padding: 1em;
		border-radius: 0.5em;
		background-color: #f0f0f0;
		box-shadow: #00000049 1px 3px 10px;
		display: flex;
		justify-content: flex-start;
		align-items: center;
		gap: 1rem;
		border: none;
		cursor: pointer;
	}

	.website-icon {
		width: 36px;
		height: 36px;
	}

	.top-bar {
		height: 3rem;
		width: 100%;
		display: flex;
		gap: 3rem;
		justify-content: space-between;
		align-items: center;
	}

	.top-bar > .right {
		display: flex;
		gap: 1rem;
		align-items: center;
	}

	.btn {
		padding: 0.6em 0.7em;
		border-radius: 0.5em;
		background-color: #4caf50;
		color: white;
		border: none;
		cursor: pointer;
	}

	.btn:hover {
		background-color: #45a049;
	}

	.search-input {
		padding: 1em;
		border-radius: 0.5em;
		border: 1px solid #ccc;
		width: 100%;
		box-sizing: border-box;
	}
</style>
