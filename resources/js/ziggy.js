    var Ziggy = {
        namedRoutes: {"design.index":{"uri":"design","methods":["GET","HEAD"],"domain":null},"design.colors":{"uri":"design\/colors","methods":["GET","HEAD"],"domain":null},"design.layout":{"uri":"design\/layout","methods":["GET","HEAD"],"domain":null},"design.spacing":{"uri":"design\/spacing","methods":["GET","HEAD"],"domain":null},"design.button":{"uri":"design\/components\/button","methods":["GET","HEAD"],"domain":null},"legal.privacy":{"uri":"legal\/privacy","methods":["GET","HEAD"],"domain":null},"legal.terms":{"uri":"legal\/terms","methods":["GET","HEAD"],"domain":null},"register.index":{"uri":"register","methods":["GET","HEAD"],"domain":null},"register.workspace.process":{"uri":"register","methods":["POST"],"domain":null},"register.customer":{"uri":"register\/customer","methods":["GET","HEAD"],"domain":null},"register.store":{"uri":"register\/customer","methods":["POST"],"domain":null},"register.complete":{"uri":"register\/complete","methods":["GET","HEAD"],"domain":null},"validate.workspace.complete":{"uri":"validate\/complete","methods":["GET","HEAD"],"domain":null},"validate.workspace.token-expired":{"uri":"validate\/token-expired","methods":["GET","HEAD"],"domain":null},"validate.workspace":{"uri":"validate\/workspace\/{token}","methods":["GET","HEAD"],"domain":null},"validate.workspace.process":{"uri":"validate\/workspace\/{token}","methods":["POST"],"domain":null},"login":{"uri":"login","methods":["GET","HEAD"],"domain":null},"login.process":{"uri":"login","methods":["POST"],"domain":null},"logout":{"uri":"logout","methods":["GET","HEAD"],"domain":null},"password.request":{"uri":"forgot-password","methods":["GET","HEAD"],"domain":null},"password.email":{"uri":"forgot-password","methods":["POST"],"domain":null},"password.reset":{"uri":"reset-password\/{token}","methods":["GET","HEAD"],"domain":null},"password.update":{"uri":"reset-password","methods":["POST"],"domain":null},"dashboard":{"uri":"dashboard","methods":["GET","HEAD"],"domain":null},"choose.workspace":{"uri":"dashboard\/choice","methods":["GET","HEAD"],"domain":null},"onboarding.start":{"uri":"onboarding\/start","methods":["GET","HEAD"],"domain":null},"onboarding.hold":{"uri":"onboarding\/hold","methods":["GET","HEAD"],"domain":null},"onboarding.complete":{"uri":"onboarding\/complete","methods":["POST"],"domain":null},"customer.settings":{"uri":"customer\/settings","methods":["GET","HEAD"],"domain":null},"customer.update":{"uri":"customer\/settings\/update\/{type}","methods":["POST"],"domain":null},"customer.show.invoice":{"uri":"customer\/settings\/invoice\/{invoiceID}","methods":["GET","HEAD"],"domain":null},"members":{"uri":"members","methods":["GET","HEAD"],"domain":null}},
        baseUrl: 'http://rebase.test/',
        baseProtocol: 'http',
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
