import FilesList from '../views/FilesList'
import FileInfo from '../views/FileInfo'
import UploadForm from '../views/UploadForm'

const routes = [
  {
    path: '/upload',
    name: 'UploadForm',
    component: UploadForm,
    meta: {
      name: 'Add files',
    }
  },
  {
    path: '/',
    name: 'FilesList',
    component: FilesList,
    meta: {
      name: 'Files list',
    }
  },
  {
    path: '/:file',
    name: 'FileInfo',
    component: FileInfo,
    meta: {
      hidden: true
    }
  }
]

export default routes;