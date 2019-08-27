class App {
  constructor() {
    this.isReady = true;

    window.addEventListener('load', () => (this.isLoaded = true));
  }
}

export default new App();
