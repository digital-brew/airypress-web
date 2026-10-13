import domReady from "@wordpress/dom-ready";
import { registerBlockType } from "@wordpress/blocks";
import * as modalBlock from "./editor/modal.block";
import "./editor/rank-math";

/**
 * Landing page sections: metadata from block.json, markup rendered by Blade
 */
const sections = import.meta.glob("./editor/blocks/*/index.js", { eager: true });

domReady(() => {
  /**
   * Register blocks with their configurations
   */
  const blocks = [modalBlock];

  blocks.forEach((block) => {
    registerBlockType(block.name, {
      apiVersion: 3,
      title: block.title,
      category: block.category,
      icon: block.icon,
      attributes: block.attributes,
      edit: block.edit,
      save: block.save,
    });
  });

  Object.values(sections).forEach(({ metadata, edit }) => {
    registerBlockType(metadata, { edit, save: () => null });
  });
});
