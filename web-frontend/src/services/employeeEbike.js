import { backend } from '@/_axios';

export default {
  createData() {
    return backend.get(`/employeeEbike/create/`);
  },
  create(data) {
    return backend.post(`/employeeEbike`, data );
  },
  editData(id) {
    return backend.get(`/employeeEbike/${id}/edit`);
  },
  update(data) {
    return backend.put(`/employeeEbike/${data.id}`, data);
  },
  delete(id) {
    return backend.delete(`/employeeEbike/${id}`);
  },
  list(params) {
    return backend.get(`/employeeEbike/`, { params });
  }
};