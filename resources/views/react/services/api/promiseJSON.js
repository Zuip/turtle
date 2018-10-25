export default function(promise) {
  return promise.then(response => {

    if([400, 404].includes(response.status)) {
      return response.json().then(
        data => Promise.reject({
          message: data,
          status: response.status
        })
      );
    }
  
    return response.json();
  });
};
