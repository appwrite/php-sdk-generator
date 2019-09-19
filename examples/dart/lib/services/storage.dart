import "package:dart_appwrite/service.dart";
import "package:dart_appwrite/client.dart";

class Storage extends Service {
     
     Storage(Client client): super(client);

     /// Get a list of all the user files. You can use the query params to filter
     /// your results. On admin mode, this endpoint will return a list of all of the
     /// project files. [Learn more about different API modes](/docs/modes).
    listFiles({search = null, limit = 25, offset = 0, orderType = 'ASC'}) async {
       String path = '/storage/files';

       var params = {
         'search': search,
         'limit': limit,
         'offset': offset,
         'orderType': orderType,
       };

       return await this.client.call('get', path: path, params: params);
    }
     /// Create a new file. The user who creates the file will automatically be
     /// assigned to read and write access unless he has passed custom values for
     /// read and write arguments.
    createFile({files, read = const [], write = const [], folderId = null}) async {
       String path = '/storage/files';

       var params = {
         'files': files,
         'read': read,
         'write': write,
         'folderId': folderId,
       };

       return await this.client.call('post', path: path, params: params);
    }
     /// Get file by its unique ID. This endpoint response returns a JSON object
     /// with the file metadata.
    getFile({fileId}) async {
       String path = '/storage/files/{fileId}'.replaceAll(RegExp('{fileId}'), fileId);

       var params = {
       };

       return await this.client.call('get', path: path, params: params);
    }
     /// Update file by its unique ID. Only users with write permissions have access
     /// to update this resource.
    updateFile({fileId, read = const [], write = const [], folderId = null}) async {
       String path = '/storage/files/{fileId}'.replaceAll(RegExp('{fileId}'), fileId);

       var params = {
         'read': read,
         'write': write,
         'folderId': folderId,
       };

       return await this.client.call('put', path: path, params: params);
    }
     /// Delete a file by its unique ID. Only users with write permissions have
     /// access to delete this resource.
    deleteFile({fileId}) async {
       String path = '/storage/files/{fileId}'.replaceAll(RegExp('{fileId}'), fileId);

       var params = {
       };

       return await this.client.call('delete', path: path, params: params);
    }
     /// Get file content by its unique ID. The endpoint response return with a
     /// &#039;Content-Disposition: attachment&#039; header that tells the browser to start
     /// downloading the file to user downloads directory.
    getFileDownload({fileId}) async {
       String path = '/storage/files/{fileId}/download'.replaceAll(RegExp('{fileId}'), fileId);

       var params = {
       };

       return await this.client.call('get', path: path, params: params);
    }
     /// Get file preview image. Currently, this method supports preview for image
     /// files (jpg, png, and gif), other supported formats, like pdf, docs, slides,
     /// and spreadsheets will return file icon image. You can also pass query
     /// string arguments for cutting and resizing your preview image.
    getFilePreview({fileId, width = 0, height = 0, quality = 100, background = null, output = null}) async {
       String path = '/storage/files/{fileId}/preview'.replaceAll(RegExp('{fileId}'), fileId);

       var params = {
         'width': width,
         'height': height,
         'quality': quality,
         'background': background,
         'output': output,
       };

       return await this.client.call('get', path: path, params: params);
    }
     /// Get file content by its unique ID. This endpoint is similar to the download
     /// method but returns with no  &#039;Content-Disposition: attachment&#039; header.
    getFileView({fileId, as = null}) async {
       String path = '/storage/files/{fileId}/view'.replaceAll(RegExp('{fileId}'), fileId);

       var params = {
         'as': as,
       };

       return await this.client.call('get', path: path, params: params);
    }
}