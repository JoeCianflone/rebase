// import fo from "lodash"

export default {
   install(Vue, options) {
      Vue.prototype.$is = {
            admin(roles) {
               let x = false;
               roles.forEach(element => {

                  if (element.type === 'xxx') {
                     x = true;
                  }
               });
               return x;
            }
      }

   }
 }
