export default function(visits) {

  let pointers = new Map();

  visits.forEach(visit => {

    if(visit.city.latitude === null || visit.city.longitude === null) {
      return;
    }

    let index = getIndex(visit);

    let pointer = pointers.get(index);

    if(typeof pointer === 'undefined') {
      pointers.set(index, [visit]);
      return;
    }

    pointer.push(visit);
  });

  return pointers;
};

function getIndex(visit) {
  return JSON.stringify({
    latitude: parseFloat(visit.city.latitude),
    longitude: parseFloat(visit.city.longitude)
  });
}
