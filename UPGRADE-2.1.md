# UPGRADE FROM `2.0` TO `2.1`

- Create env vars : 

```
RECAPTCHA3_SCORE_THRESHOLD=0.5
RECAPTCHA3_ENABLED=true
ALTCHA_ENABLED=false
ALTCHA_SECRET=CHANGEME
```

- If you want to switch on Atcha, you can set `ALTCHA_ENABLED` to `true` and set the `ALTCHA_SECRET` to your secret key.

You can generate `ALTCHA_SECRET` with command `openssl rand -hex 32`

- Copy config files like in the recipe : https://github.com/monsieurbiz/symfony-recipes/tree/master/monsieurbiz/sylius-anti-spam-plugin/2.1/config
