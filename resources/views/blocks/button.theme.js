// theme.json styles for the core/button block
export default {
  styles: {
    blocks: {
      "core/button": {
        border: {
          radius: "0",
        },
        color: {
          background: "var(--wp--preset--color--black)",
          text: "var(--wp--preset--color--white)",
        },
        variations: {
          outline: {
            border: {
              width: "1px",
              color: "var(--wp--preset--color--black)",
            },
            color: {
              background: "transparent",
              text: "var(--wp--preset--color--black)",
            },
          },
        },
      },
    },
    elements: {
      button: {
        border: {
          radius: "0",
        },
      },
    },
  },
};
