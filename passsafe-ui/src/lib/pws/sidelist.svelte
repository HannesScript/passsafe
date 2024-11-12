<script lang="ts">
    import getWebsiteIcon from "$lib/getwebsiteicon";
	import { onMount } from "svelte";

    let pws = [
        {
            name: "Google",
            username: "user",
            password: "password",
            url: "https://google.com",
            img: "",
        },
        {
            name: "Facebook",
            username: "user",
            password: "password",
            url: "https://facebook.com",
            img: "",
        },
        {
            name: "Twitter",
            username: "user",
            password: "password",
            url: "https://twitter.com",
            img: "",
        },
        {
            name: "Instagram",
            username: "user",
            password: "password",
            url: "https://instagram.com",
            img: "",
        },
        {
            name: "LinkedIn",
            username: "user",
            password: "password",
            url: "https://linkedin.com",
            img: "",
        },
        {
            name: "Reddit",
            username: "user",
            password: "password",
            url: "https://reddit.com",
            img: "",
        },
        {
            name: "Twitch",
            username: "user",
            password: "password",
            url: "https://twitch.com",
            img: "",
        },
        {
            name: "Spotify",
            username: "user",
            password: "password",
            url: "https://spotify.com",
            img: "",
        },
        {
            name: "Netflix",
            username: "user",
            password: "password",
            url: "https://netflix.com",
            img: "",
        },
        {
            name: "Amazon",
            username: "user",
            password: "password",
            url: "https://amazon.com",
            img: "",
        },
        {
            name: "Ebay",
            username: "user",
            password: "password",
            url: "https://ebay.com",
            img: "",
        },
        {
            name: "Paypal",
            username: "user",
            password: "password",
            url: "https://paypal.com",
            img: "",
        },
        {
            name: "Github",
            username: "user",
            password: "password",
            url: "https://github.com",
            img: "",
        },
        {
            name: "Gitlab",
            username: "user",
            password: "password",
            url: "https://gitlab.com",
            img: "",
        },
        {
            name: "Bitbucket",
            username: "user",
            password: "password",
            url: "https://bitbucket.com",
            img: "",
        },
        {
            name: "Jira",
            username: "user",
            password: "password",
            url: "https://jira.com",
            img: "",
        },
        {
            name: "Confluence",
            username: "user",
            password: "password",
            url: "https://confluence.com",
            img: "",
        },
        {
            name: "Slack",
            username: "user",
            password: "password",
            url: "https://slack.com",
            img: "",
        },
        {
            name: "Discord",
            username: "user",
            password: "password",
            url: "https://discord.com",
            img: "",
        },
        {
            name: "Zoom",
            username: "user",
            password: "password",
            url: "https://zoom.com",
            img: "",
        },
        {
            name: "Teams",
            username: "user",
            password: "password",
            url: "https://teams.com",
            img: "",
        },
        {
            name: "Skype",
            username: "user",
            password: "password",
            url: "https://skype.com",
            img: "",
        },
        {
            name: "Whatsapp",
            username: "user",
            password: "password",
            url: "https://whatsapp.com",
            img: "",
        },
        {
            name: "Telegram",
            username: "user",
            password: "password",
            url: "https://telegram.com",
            img: "",
        },
        {
            name: "Signal",
            username: "user",
            password: "password",
            url: "https://signal.com",
            img: "",
        },
        {
            name: "Viber",
            username: "user",
            password: "password",
            url: "https://viber.com",
            img: "",
        },
        {
            name: "Messenger",
            username: "user",
            password: "password",
            url: "https://messenger.com",
            img: "",
        },
        {
            name: "Snapchat",
            username: "user",
            password: "password",
            url: "https://snapchat.com",
            img: "",
        },
        {
            name: "Tiktok",
            username: "user",
            password: "password",
            url: "https://tiktok.com",
            img: "",
        },
        {
            name: "Pinterest",
            username: "user",
            password: "password",
            url: "https://pinterest.com",
            img: "",
        }
    ];

    onMount(async () => {
        pws = await Promise.all(pws.map(async pw => {
            console.log(await getWebsiteIcon(pw.url).then(r => r));
            
            return {
                ...pw,
                img: await getWebsiteIcon(pw.url).then(r => r)
            };
        }));
    });
</script>

<div class="main">
    {#each pws as pw}
        <button class="item">
            <img src={pw.img || "https://fonts.gstatic.com/s/i/short-term/release/materialsymbolsoutlined/lock/default/48px.svg"} alt="Website icon" class="website-icon">
            <h3>{pw.name}</h3>
        </button>
    {/each}
</div>

<style>
    .main {
        padding: 1em;
        flex: 1.5;
        min-width: 20dvw;
        display: flex;
        flex-direction: column;
        gap: 2rem;
        min-height: 100dvh;
        /* Smal black line at the right */
        border-right: 1px solid #00000049;
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
</style>