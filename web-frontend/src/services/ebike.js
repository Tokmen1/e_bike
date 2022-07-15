import { backend } from '@/_axios';

export default {
  createData() {
    return backend.get(`/ebike/create/`);
  },
  create(data) {
    return backend.post(`/ebike`, data );
  },
  editData(id) {
    return backend.get(`/ebike/${id}/edit`);
  },
  update(data) {
    return backend.put(`/ebike/${data.id}`, data);
  },
  delete(id) {
    return backend.delete(`/ebike/${id}`);
  },
  list() {
    return backend.get(`/ebike/`);
  }
};