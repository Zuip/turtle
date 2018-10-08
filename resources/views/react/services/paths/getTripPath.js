export default function(trip, translations) {
  return (
    '/' + translations.routes.trips
    + '/' + trip.urlName
  );
}