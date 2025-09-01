# UPGRADE FROM `1.3.1` TO `1.4.0`

- Preconditions: PHP 8.2 support

- Copy config files from dist files, run the command:
```
cp -r vendor/monsieurbiz/sylius-anti-spam-plugin/dist/config config/
```

- Create env vars:

```
RECAPTCHA3_SCORE_THRESHOLD=0.5
RECAPTCHA3_ENABLED=true
ALTCHA_ENABLED=false
ALTCHA_SECRET=CHANGEME
```

- If you want to switch on Atcha, you can set `ALTCHA_ENABLED` to `true` and set the `ALTCHA_SECRET` to your secret key.

You can generate `ALTCHA_SECRET` with command `openssl rand -hex 32`

