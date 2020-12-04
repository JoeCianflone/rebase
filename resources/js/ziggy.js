    var Ziggy = {
        namedRoutes: {"member.validate":{"uri":"{customerID}\/member\/{memberID}\/validate\/{token}","methods":["GET","HEAD"],"domain":"my.rebase.test"},"member.verify":{"uri":"{customerID}\/member\/{memberID}\/validate\/{token}","methods":["POST"],"domain":"my.rebase.test"},"pick":{"uri":"{customerID}\/pick","methods":["GET","HEAD"],"domain":"my.rebase.test"},"customer.index":{"uri":"{customerID}\/customer","methods":["GET","HEAD"],"domain":"my.rebase.test"},"signin":{"uri":"signin","methods":["GET","HEAD"],"domain":"auth.rebase.test"},"login.process":{"uri":"login","methods":["POST"],"domain":"auth.rebase.test"},"logout":{"uri":"logout","methods":["GET","HEAD"],"domain":"auth.rebase.test"},"password.request":{"uri":"forgot-password","methods":["GET","HEAD"],"domain":"auth.rebase.test"},"password.email":{"uri":"forgot-password","methods":["POST"],"domain":"auth.rebase.test"},"password.reset":{"uri":"reset-password\/{token}","methods":["GET","HEAD"],"domain":"auth.rebase.test"},"password.update":{"uri":"reset-password","methods":["POST"],"domain":"auth.rebase.test"},"design.index":{"uri":"design","methods":["GET","HEAD"],"domain":null},"design.colors":{"uri":"design\/colors","methods":["GET","HEAD"],"domain":null},"design.layout":{"uri":"design\/layout","methods":["GET","HEAD"],"domain":null},"design.spacing":{"uri":"design\/spacing","methods":["GET","HEAD"],"domain":null},"design.button":{"uri":"design\/components\/button","methods":["GET","HEAD"],"domain":null},"privacy":{"uri":"legal\/privacy","methods":["GET","HEAD"],"domain":"rebase.test"},"terms":{"uri":"legal\/terms","methods":["GET","HEAD"],"domain":"rebase.test"},"register.index":{"uri":"register","methods":["GET","HEAD"],"domain":"rebase.test"},"register.check.slug":{"uri":"register","methods":["POST"],"domain":"rebase.test"},"register.email":{"uri":"register\/email","methods":["GET","HEAD"],"domain":"rebase.test"},"register.check.email":{"uri":"register\/email","methods":["POST"],"domain":"rebase.test"},"register.customer":{"uri":"register\/customer","methods":["GET","HEAD"],"domain":"rebase.test"},"register.store":{"uri":"register\/customer","methods":["POST"],"domain":"rebase.test"},"register.complete":{"uri":"register\/complete","methods":["GET","HEAD"],"domain":"rebase.test"},"search.index":{"uri":"search","methods":["GET","HEAD"],"domain":"rebase.test"},"search.process":{"uri":"search","methods":["POST"],"domain":"rebase.test"},"search.show":{"uri":"search\/results","methods":["GET","HEAD"],"domain":"rebase.test"},"dashboard":{"uri":"dashboard","methods":["GET","HEAD"],"domain":null},"onboarding.start":{"uri":"onboarding\/start","methods":["GET","HEAD"],"domain":null},"onboarding.hold":{"uri":"onboarding\/hold","methods":["GET","HEAD"],"domain":null},"onboarding.complete":{"uri":"onboarding\/complete","methods":["POST"],"domain":null},"members":{"uri":"members","methods":["GET","HEAD"],"domain":null}},
        baseUrl: 'https://rebase.test/',
        baseProtocol: 'https',
        baseDomain: 'rebase.test',
        basePort: false,
        defaultParameters: []
    };

    if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
        for (var name in window.Ziggy.namedRoutes) {
            Ziggy.namedRoutes[name] = window.Ziggy.namedRoutes[name];
        }
    }

    export {
        Ziggy
    }
