import { backend } from '@/_axios';

export default {
  createData() {
    return backend.get(`/employee/create/`);
  },
  create(data) {
    return backend.post(`/employee`, data );
  },
  editData(id) {
    return backend.get(`/employee/${id}/edit`);
  },
  update(data) {
    return backend.put(`/employee/${data.id}`, data);
  },
  delete(id) {
    return backend.delete(`/employee/${id}`);
  },
  list() {
    return backend.get(`/employee/`);
  }
};