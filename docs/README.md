# Radicle Documentation

Welcome to the Radicle project documentation. This guide covers everything from initial setup to advanced development patterns.

## 📚 Documentation Structure

### 🚀 Setup & Installation
Get Radicle up and running in your environment.

- [Installation Guide](setup/installation.md) - Install Radicle and dependencies
- [Local Development](setup/local-development.md) - Set up your local development environment  
- [Deployment](setup/deployment.md) - Deploy to staging and production

### 📖 How-To Guides
Learn how to work with Radicle's features and functionality.

- [Service Providers](guides/service-providers.md) - Configure and create service providers
- [Theme Configuration](guides/theme-configuration.md) - Set up theme supports, menus, and sidebars
- [Post Types & Taxonomies](guides/post-types.md) - Create custom post types and taxonomies
- [Models](guides/models.md) - Working with Eloquent models for WordPress data
- [Block Development](guides/blocks.md) - Create and customize Gutenberg blocks
- [Testing Guide](guides/testing.md) - How to run and work with tests


### ✨ Code Style & Development
Conventions and patterns for writing consistent, maintainable code.

- [Code Style Overview](style/README.md) - Overview of all coding standards
- [PHP Conventions](style/php.md) - PHP syntax, WordPress integration, Laravel patterns
- [Frontend Development](style/frontend.md) - HTML, CSS, and JavaScript conventions

## 🏗️ Project Structure

```
├── app/                 # Application code
│   ├── Blocks/          # Block rendering logic
│   │   └── Core/        # WordPress core block customizations
│   ├── Models/          # Eloquent models for WordPress data
│   ├── Providers/       # Service providers
│   ├── View/            # View composers and components
│   └── helpers.php      # Global helper functions
├── config/              # Configuration files
├── docs/                # Documentation
├── resources/
│   ├── css/             # Stylesheets
│   ├── js/              # JavaScript and block definitions
│   │   └── editor/      # Block editor components
│   └── views/           # Blade templates
│       ├── blocks/      # Block templates
│       └── components/  # Reusable components
├── tests/
│   ├── e2e/             # Playwright E2E tests
│   └── *.php            # Pest PHP tests
└── public/
    ├── content/         # WordPress content directory
    └── wp/              # WordPress core
```

## ⚙️ Environment Requirements

- PHP >= 8.2 with extensions: BCMath, Ctype, Fileinfo, JSON, Mbstring, Tokenizer, XML
- Composer
- WP-CLI  
- Node.js >= 20 for asset compilation and E2E testing

## 🎯 Quick Start

1. **New to Radicle?** Start with [Installation Guide](setup/installation.md)
2. **Setting up development?** Check [Local Development](setup/local-development.md)
3. **Writing code?** Review [Code Style Overview](style/README.md)
4. **Building custom blocks?** See [Block Development](guides/blocks.md)
5. **Need help?** See support section in main README

**💡 Demo Pages**: Visit the `/welcome/` route to see interactive examples of Radicle's built-in components, or check out the front page template that demonstrates Eloquent models and view composers in action.
