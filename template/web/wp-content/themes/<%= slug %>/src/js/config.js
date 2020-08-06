/**
 * Test if the current env is a dev env.
 *
 * @return {Boolean}
 */
export const isDev = () => !window.location.hostname.startsWith('www.');

export default {
  isDev,
};
