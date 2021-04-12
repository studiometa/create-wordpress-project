import Base from '@studiometa/js-toolkit';
import { isDev } from './config';
import Component from './components/Component';

/**
 * Main App class.
 */
class App extends Base {
  /**
   * App config.
   * @return {Object}
   */
  static config = {
    log: isDev(),
    name: 'App',
    components: {
      Component,
    },
  };

  /**
   * Log a nice message when app is ready.
   *
   * @return {void}
   */
  mounted() {
    this.$log('mounted 🎉');
  }
}

const app = new App(document.documentElement);
app.$mount();
export default app;
