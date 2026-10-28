import alpine from "alpinejs";
import newsletter from "./components/newsletter";
import pricing from "./components/pricing";
import stickyHeader from "./components/sticky-header";
import videoSection from "./components/video-section";

Object.assign(window, { Alpine: alpine });

alpine.data("newsletter", newsletter);
alpine.data("pricing", pricing);
alpine.data("stickyHeader", stickyHeader);
alpine.data("videoSection", videoSection);
alpine.start();
