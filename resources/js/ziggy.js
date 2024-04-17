const Ziggy = {"url":"http:\/\/127.0.0.1:8000","port":8000,"defaults":{},"routes":{"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"ignition.healthCheck":{"uri":"_ignition\/health-check","methods":["GET","HEAD"]},"ignition.executeSolution":{"uri":"_ignition\/execute-solution","methods":["POST"]},"ignition.updateConfig":{"uri":"_ignition\/update-config","methods":["POST"]},"dashboard":{"uri":"\/","methods":["GET","HEAD"]},"vehicle-category.index":{"uri":"vehicle-category","methods":["GET","HEAD"]},"vehicle-category.all":{"uri":"vehicle-category\/all","methods":["GET","HEAD"]},"vehicle-category.store":{"uri":"vehicle-category\/store","methods":["POST"]},"vehicle-category.get":{"uri":"vehicle-category\/{vehicle_id}\/get","methods":["GET","HEAD"],"parameters":["vehicle_id"]},"vehicle-category.delete":{"uri":"vehicle-category\/{vehicle_id}\/delete","methods":["DELETE"],"parameters":["vehicle_id"]},"vehicle-category.update":{"uri":"vehicle-category\/{vehicle_id}\/update","methods":["POST"],"parameters":["vehicle_id"]},"vehicle-category.list":{"uri":"vehicle-category\/list","methods":["GET","HEAD"]},"vehicle-category.changeStatus":{"uri":"vehicle-category\/{vehicle_id}\/changeStatus","methods":["POST"],"parameters":["vehicle_id"]},"vehicle-category.delete.selected":{"uri":"vehicle-category\/{vehicle_id}\/select\/vehicle\/delete","methods":["POST"],"parameters":["vehicle_id"]},"vehicle-category.inactive.selected":{"uri":"vehicle-category\/select\/vehicle\/inactive","methods":["POST"]},"vehicle-category.active.selected":{"uri":"vehicle-category\/select\/vehicle\/active","methods":["POST"]},"country.index":{"uri":"country","methods":["GET","HEAD"]},"country.all":{"uri":"country\/all","methods":["GET","HEAD"]},"country.store":{"uri":"country\/store","methods":["POST"]},"country.get":{"uri":"country\/{country_id}\/get","methods":["GET","HEAD"],"parameters":["country_id"]},"country.delete":{"uri":"country\/{country_id}\/delete","methods":["DELETE"],"parameters":["country_id"]},"country.update":{"uri":"country\/{country_id}\/update","methods":["POST"],"parameters":["country_id"]},"country.list":{"uri":"country\/list","methods":["GET","HEAD"]},"country.changeStatus":{"uri":"country\/{country_id}\/changeStatus","methods":["POST"],"parameters":["country_id"]},"country.delete.selected":{"uri":"country\/{country_id}\/select\/country\/delete","methods":["POST"],"parameters":["country_id"]},"country.inactive.selected":{"uri":"country\/select\/country\/inactive","methods":["POST"]},"country.active.selected":{"uri":"country\/select\/country\/active","methods":["POST"]},"register":{"uri":"register","methods":["GET","HEAD"]},"login":{"uri":"login","methods":["GET","HEAD"]},"password.request":{"uri":"forgot-password","methods":["GET","HEAD"]},"password.email":{"uri":"forgot-password","methods":["POST"]},"password.reset":{"uri":"reset-password\/{token}","methods":["GET","HEAD"],"parameters":["token"]},"password.store":{"uri":"reset-password","methods":["POST"]},"verification.notice":{"uri":"verify-email","methods":["GET","HEAD"]},"verification.verify":{"uri":"verify-email\/{id}\/{hash}","methods":["GET","HEAD"],"parameters":["id","hash"]},"verification.send":{"uri":"email\/verification-notification","methods":["POST"]},"password.confirm":{"uri":"confirm-password","methods":["GET","HEAD"]},"password.update":{"uri":"password","methods":["PUT"]},"logout":{"uri":"logout","methods":["POST"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
