<script lang="ts">
    let pws = [
        {
            name: "Google",
            username: "user",
            password: "password",
            url: "https://google.com",
        },
        {
            name: "Facebook",
            username: "user",
            password: "password",
            url: "https://facebook.com",
        },
        {
            name: "Twitter",
            username: "user",
            password: "password",
            url: "https://twitter.com",
        },
        {
            name: "Instagram",
            username: "user",
            password: "password",
            url: "https://instagram.com",
        },
        {
            name: "LinkedIn",
            username: "user",
            password: "password",
            url: "https://linkedin.com",
        },
        {
            name: "Reddit",
            username: "user",
            password: "password",
            url: "https://reddit.com",
        },
        {
            name: "Twitch",
            username: "user",
            password: "password",
            url: "https://twitch.com",
        },
        {
            name: "Spotify",
            username: "user",
            password: "password",
            url: "https://spotify.com",
        },
        {
            name: "Netflix",
            username: "user",
            password: "password",
            url: "https://netflix.com",
        },
        {
            name: "Amazon",
            username: "user",
            password: "password",
            url: "https://amazon.com",
        },
        {
            name: "Ebay",
            username: "user",
            password: "password",
            url: "https://ebay.com",
        },
        {
            name: "Paypal",
            username: "user",
            password: "password",
            url: "https://paypal.com",
        },
        {
            name: "Github",
            username: "user",
            password: "password",
            url: "https://github.com",
        },
        {
            name: "Gitlab",
            username: "user",
            password: "password",
            url: "https://gitlab.com",
        },
        {
            name: "Bitbucket",
            username: "user",
            password: "password",
            url: "https://bitbucket.com",
        },
        {
            name: "Jira",
            username: "user",
            password: "password",
            url: "https://jira.com",
        },
        {
            name: "Confluence",
            username: "user",
            password: "password",
            url: "https://confluence.com",
        },
        {
            name: "Slack",
            username: "user",
            password: "password",
            url: "https://slack.com",
        },
        {
            name: "Discord",
            username: "user",
            password: "password",
            url: "https://discord.com",
        },
        {
            name: "Zoom",
            username: "user",
            password: "password",
            url: "https://zoom.com",
        },
        {
            name: "Teams",
            username: "user",
            password: "password",
            url: "https://teams.com",
        },
        {
            name: "Skype",
            username: "user",
            password: "password",
            url: "https://skype.com",
        },
        {
            name: "Whatsapp",
            username: "user",
            password: "password",
            url: "https://whatsapp.com",
        },
        {
            name: "Telegram",
            username: "user",
            password: "password",
            url: "https://telegram.com",
        },
        {
            name: "Signal",
            username: "user",
            password: "password",
            url: "https://signal.com",
        },
        {
            name: "Viber",
            username: "user",
            password: "password",
            url: "https://viber.com",
        },
        {
            name: "Messenger",
            username: "user",
            password: "password",
            url: "https://messenger.com",
        },
        {
            name: "Snapchat",
            username: "user",
            password: "password",
            url: "https://snapchat.com",
        },
        {
            name: "Tiktok",
            username: "user",
            password: "password",
            url: "https://tiktok.com",
        },
        {
            name: "Pinterest",
            username: "user",
            password: "password",
            url: "https://pinterest.com",
        }
    ];
</script>

<div class="main">
    {#each pws as pw}
        <div>
            <h3>{pw.name}</h3>
            <p>{pw.username}</p>
            <p>{pw.password}</p>
            <a href={pw.url} target="_blank">Open</a>
        </div>
    {/each}
</div>

<style>
    .main {
        padding: 1em;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }
</style>