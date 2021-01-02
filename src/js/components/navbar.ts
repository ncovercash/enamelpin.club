export default function draw(): void {
	const nav = document.querySelector("nav");

	const html = [];
	html.push(`<a href="${window.ENAMEL_PIN_CLUB.root}">Home</a>`);
	html.push(`<a href="${window.ENAMEL_PIN_CLUB.root}Pins">Browse Pins</a>`);
	if (window.ENAMEL_PIN_CLUB.isLoggedIn) {
		html.push(`<a href="${window.ENAMEL_PIN_CLUB.root}Collection">My Pins</a>`);
		html.push(`<a href="${window.ENAMEL_PIN_CLUB.root}Logout">Logout</a>`);
	} else {
		html.push(`<a href="${window.ENAMEL_PIN_CLUB.root}Login">Login</a>`);
	}
	nav.innerHTML = html.join("");
}
