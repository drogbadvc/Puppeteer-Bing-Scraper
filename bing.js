#!/usr/bin/env node
const puppeteer = require("puppeteer");
const fs = require('fs');

(async () => {
const browser = await puppeteer.launch();

const page = await browser.newPage();
await page.goto('https://www.bing.com/account/general');
await page.setViewport({width: 1920, height: 4200});
await page.select('#rpp', '50');
await page.waitFor(2000);
await page.click('#sv_btn');
await page.waitFor(2000);
await page.focus('#sb_form_q');
page.keyboard.type('seo');
await page.waitFor(2000);
await page.keyboard.press('Enter');
await page.waitFor(2000);
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;
    await page.screenshot({path: 'assets/ranks/bing/'+today+'.png', fullpage: true});
    content = await page.content();
    fs.writeFile('assets/ranks/bing/html/' + today + '.html', content , (err) => {});
await browser.close();
})();

