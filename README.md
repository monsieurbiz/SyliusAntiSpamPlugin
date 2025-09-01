[![Banner of Sylius Anti Spam plugin](docs/images/antispam-banner.jpg)](https://monsieurbiz.com/agence-web-experte-sylius)

<h1 align="center">Anti Spam</h1>

[![Anti Spam Plugin license](https://img.shields.io/github/license/monsieurbiz/SyliusAntiSpamPlugin?public)](https://github.com/monsieurbiz/SyliusAntiSpamPlugin/blob/master/LICENSE.txt)
[![Tests Status](https://img.shields.io/github/actions/workflow/status/monsieurbiz/SyliusAntiSpamPlugin/tests.yaml?branch=master&logo=github)](https://github.com/monsieurbiz/SyliusAntiSpamPlugin/actions?query=workflow%3ATests)
[![Recipe Status](https://img.shields.io/github/actions/workflow/status/monsieurbiz/SyliusAntiSpamPlugin/recipe.yaml?branch=master&label=recipes&logo=github)](https://github.com/monsieurbiz/SyliusAntiSpamPlugin/actions?query=workflow%3ASecurity)
[![Security Status](https://img.shields.io/github/actions/workflow/status/monsieurbiz/SyliusAntiSpamPlugin/security.yaml?branch=master&label=security&logo=github)](https://github.com/monsieurbiz/SyliusAntiSpamPlugin/actions?query=workflow%3ASecurity)

This plugins adds captcha and allows you to manage your spams.

## Compatibility

| Sylius Version | PHP Version |
|----------------|-------------|
| 1.13           | 8.2 - 8.3   |
| 1.14           | 8.2 - 8.3   |

## Installation

If you want to use our recipes, you can configure your composer.json by running:

```bash
composer config --no-plugins --json extra.symfony.endpoint '["https://api.github.com/repos/monsieurbiz/symfony-recipes/contents/index.json?ref=flex/master","flex://defaults"]'
```

```bash
composer require monsieurbiz/sylius-anti-spam-plugin
```

Run post installation command
```bash
cp -r vendor/monsieurbiz/sylius-anti-spam-plugin/dist/config config/
```

<details>
<summary>For the installation without flex, follow these additional steps</summary>
<p>

Change your `config/bundles.php` file to add the line for the plugin :

```php
<?php

return [
    //..
    MonsieurBiz\SyliusRichEditorPlugin\MonsieurBizSyliusAntiSpamPlugin::class => ['all' => true],
];
```

Then create the config file in `config/packages/monsieurbiz_sylius_anti_spam_plugin.yaml` :

```yaml
imports:
    - { resource: "@MonsieurBizSyliusAntiSpamPlugin/Resources/config/config.yaml" }

services:
    # Add the "monsieurbiz_anti_spam.quarantineable" tag on the quarantineable entity (not autoconfigure the entity…)
    App\Entity\Customer\Customer:
        tags: ['monsieurbiz_anti_spam.quarantineable']
```

Finally import the routes in `config/routes/monsieurbiz_sylius_anti_spam_plugin.yaml` :

```yaml
monsieurbiz_sylius_anti_spam_admin:
    resource: "@MonsieurBizSyliusAntiSpamPlugin/Resources/config/routes/admin.yaml"
    prefix: /%sylius_admin.path_name%
```
</p>
</details>

**Update customer entity**

Your `Customer` entity should implement `MonsieurBiz\SyliusAntiSpamPlugin\Entity\QuarantineItemAwareInterface` and use the `MonsieurBiz\SyliusAntiSpamPlugin\Entity\QuarantineItemAwareTrait` trait.

```diff
namespace App\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;
+ use MonsieurBiz\SyliusAntiSpamPlugin\Entity\QuarantineItemAwareInterface;
+ use MonsieurBiz\SyliusAntiSpamPlugin\Entity\QuarantineItemAwareTrait;
use Sylius\Component\Core\Model\Customer as BaseCustomer;

#[ORM\Entity]
#[ORM\Table(name: 'sylius_customer')]
- class Customer extends BaseCustomer
+ class Customer extends BaseCustomer implements QuarantineItemAwareInterface
{
+     use QuarantineItemAwareTrait
}
```

**Update your database schema**

Update your database schema with the plugin migrations:

```bash
bin/console doctrine:migrations:migrate
```

Generate the migration and update your database schema with the new customer entity field:

```bash
bin/console doctrine:migrations:diff
bin/console doctrine:migrations:migrate
```

## Documentation

⚙️ To Be Completed.

### Remove automatically quarantine entities (experimental)

1. Add the `monsieurbiz_anti_spam.quarantineable` tag on our entity, for example for Customer:

```yaml
    App\Entity\Customer\Customer:
        tags: ['monsieurbiz_anti_spam.quarantineable']
```

2. Confirm or adjust the exceeded periods, by quarantine level, before remove the entities. By default, the:

- suspected item is removed after 1 year
- likely item is removed after 182 days
- proven item is removed after 90 days

You can change there periods in `config/packages/monsieurbiz_sylius_anti_spam_plugin.yaml`:
```yaml
monsieurbiz_sylius_anti_spam:
    exceeded:
        suspected: '1 day'

```

3. Add in your crontab the remove command, example:

```bash
0 */6 * * * /usr/bin/flock -n /tmp/lock.app.remove_exceeded_quarantine bin/console monsieurbiz:anti-spam:remove-exceeded-quarantine-items
```

## Contributing

You can open an Issue or a Pull Request if you want! 😘  
Thank you!

## Sponsors

This plugin is sponsored by:

- [Épices Rœllinger](https://www.epices-roellinger.com/)
- [Monsieur Biz](https://monsieurbiz.com/)

## License

This plugin is completely free and released under the [MIT License](LICENSE.txt).
