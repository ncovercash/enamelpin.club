import Debug from "debug";
const debug = Debug("enamelpin.club:onload");

import * as jQuery from "jquery";
import "what-input";
import whenDomReady from "when-dom-ready";

import "../scss/entry.scss";

// Must use require explicitly as imports are hoisted
require("foundation-sites");

whenDomReady().then((): void => {
	debug("Document onload fired!");

	jQuery(document).foundation();
});
