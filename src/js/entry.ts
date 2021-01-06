import Debug from "debug";
import whenDomReady from "when-dom-ready";
import "../css/base/entry.pcss";
import "../css/components/entry.pcss";
import "../css/utilities/entry.pcss";
import drawNavbar from "./components/navbar";
const debug = Debug("enamelpin.club:onload");

if (
	window.ENAMEL_PIN_CLUB.isLoggedIn === false &&
	window.matchMedia("(prefers-color-scheme: dark)").matches
) {
	document.body.classList.add("dark");
} else if (window.ENAMEL_PIN_CLUB.isLoggedIn && window.ENAMEL_PIN_CLUB.dark) {
	document.body.classList.add("dark");
}

drawNavbar();

whenDomReady().then((): void => {
	debug("Document onload fired!");
});
