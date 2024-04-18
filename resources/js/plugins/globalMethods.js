// plugins/globalMethods.js
import { reactive } from 'vue';

export default {
  install(app) {
    const globalState = reactive({
      isLoading: false,
      notify: { show: false, message: '', type: '' }
    });

    app.provide('globalState', globalState);

    app.config.globalProperties.$loader = {
      start() { globalState.isLoading = true; },
      finish() { globalState.isLoading = false; }
    };

    app.config.globalProperties.$notify = {
      success(message) {
        globalState.notify = { show: true, message, type: 'success' };
        // Reset after a delay
        setTimeout(() => globalState.notify.show = false, 3000);
      },
      error(message) {
        globalState.notify = { show: true, message, type: 'error' };
        setTimeout(() => globalState.notify.show = false, 3000);
      }
    };
  }
};
