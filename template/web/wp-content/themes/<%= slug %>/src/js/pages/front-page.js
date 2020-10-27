import Base from '@studiometa/js-toolkit';

/**
 * Homepage class.
 */
class FrontPage extends Base {
  /**
   * Class cofnig
   * @return {Object}
   */
  get config() {
    return {
      name: 'FrontPage',
    };
  }
}

// Export a new instance of Home mounted on the page's <body>.
export default new FrontPage(document.body);
