const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"register":{"uri":"register","methods":["GET","HEAD"]},"login":{"uri":"login","methods":["GET","HEAD"]},"password.request":{"uri":"forgot-password","methods":["GET","HEAD"]},"password.email":{"uri":"forgot-password","methods":["POST"]},"password.reset":{"uri":"reset-password\/{token}","methods":["GET","HEAD"]},"password.update":{"uri":"reset-password","methods":["POST"]},"verification.notice":{"uri":"verify-email","methods":["GET","HEAD"]},"verification.verify":{"uri":"verify-email\/{id}\/{hash}","methods":["GET","HEAD"]},"verification.send":{"uri":"email\/verification-notification","methods":["POST"]},"password.confirm":{"uri":"confirm-password","methods":["GET","HEAD"]},"logout":{"uri":"logout","methods":["POST"]},"candidate.home":{"uri":"\/","methods":["GET","HEAD"]},"candidate.job.index":{"uri":"jobs","methods":["GET","HEAD"]},"company.register":{"uri":"company\/register","methods":["GET","HEAD"]},"company.login":{"uri":"company\/login","methods":["GET","HEAD"]},"company.password.request":{"uri":"company\/forgot-password","methods":["GET","HEAD"]},"company.password.email":{"uri":"company\/forgot-password","methods":["POST"]},"company.password.reset":{"uri":"company\/reset-password\/{token}","methods":["GET","HEAD"]},"company.password.update":{"uri":"company\/reset-password","methods":["POST"]},"company.verification.notice":{"uri":"company\/verify-email","methods":["GET","HEAD"]},"company.verification.verify":{"uri":"company\/verify-email\/{id}\/{hash}","methods":["GET","HEAD"]},"company.verification.send":{"uri":"company\/email\/verification-notification","methods":["POST"]},"company.password.confirm":{"uri":"company\/confirm-password","methods":["GET","HEAD"]},"company.logout":{"uri":"company\/logout","methods":["POST"]},"company.dashboard":{"uri":"company\/dashboard","methods":["GET","HEAD"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };