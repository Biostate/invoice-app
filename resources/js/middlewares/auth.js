export default function auth({ next, auth, to }) {
  if (!auth.user) {
    return next({
      name: "login",
    });
  }

  return next();
}
