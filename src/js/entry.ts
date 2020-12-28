import Debug from "debug";
const debug = Debug("enamelpin.club:onload");

import whenDomReady from "when-dom-ready";

import "../css/entry.css";

whenDomReady().then((): void => {
	debug("Document onload fired!");
});
