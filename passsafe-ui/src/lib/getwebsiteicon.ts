async function getWebsiteIcon(url: string): Promise<string> {
  try {
    const domain = new URL(url).hostname;
    return `https://www.google.com/s2/favicons?domain=${domain}&sz=64`;  // Größe kann angepasst werden
  } catch (e) {
    return "";
  }
}

export default getWebsiteIcon;