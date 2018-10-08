export default function(user, translations) {
  return '/' + translations.routes.users
       + '/' + user.name;
}