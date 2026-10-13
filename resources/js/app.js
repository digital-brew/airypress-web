import alpine from "alpinejs";
import newsletter from "./components/newsletter";
import stickyHeader from "./components/sticky-header";

Object.assign(window, { Alpine: alpine });

alpine.data("newsletter", newsletter);
alpine.data("stickyHeader", stickyHeader);
alpine.start();
