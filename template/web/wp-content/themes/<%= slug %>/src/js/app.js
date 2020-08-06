import { Base } from '@studiometa/js-toolkit';
import { isDev } from './config';

/**
 * Main App class.
 */
class App extends Base {
  /**
   * App config.
   * @return {Object}
   */
  get config() {
    return {
      log: isDev(),
      name: 'App',
      components: {},
    };
  }

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
window.app = app;
export default app;
