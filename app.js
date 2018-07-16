const serve = require('koa-static'),
    router = require('koa-router')(),
    axios = require('axios'),
    Koa = require('koa'),
    app = new Koa();

router.get('/m/:url', async(ctx, next) => {
    var res = await axios.get('https://api.momoyuedu.cn/m/users/' + ctx.params.url, {
        params: ctx.request.query
    })
    ctx.body = res.data
})

app.use(router.routes()).use(router.allowedMethods()).use(serve('static')).listen(3000);

console.log('listening on port 3000');