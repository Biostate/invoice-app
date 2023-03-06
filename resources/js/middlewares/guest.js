export default function guest({ next, auth }) {
  if (auth.user) {
    return next({
      name: "home",
    });
  }

  return next();
}
