import Debug from "debug";
import whenDomReady from "when-dom-ready";
import "../css/entry.css";
import drawNavbar from "./components/navbar";
const debug = Debug("enamelpin.club:onload");

drawNavbar();

whenDomReady().then((): void => {
	debug("Document onload fired!");
});
