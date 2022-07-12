import axios from 'axios';
var backend = '';

backend = axios.create({
    baseURL: "http://"+location.hostname+":3000/api"
});
export { backend };