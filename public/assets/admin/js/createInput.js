
// Thêm ảnh mới
function createImage() {
    $('#additional-images').append(`
        <div class="image-group d-flex row align-items-baseline justify-content-between m-1 p-1 border rounded">
            <input type="file" class="form-control image_product col-10" name="images[]" accept="image/*">
            <a href="javascript:void(0)" class="btn btn-danger delete-image" onclick="deleteImage(this)">Xóa</a>
        </div>
    `);
}


let removedImages = [];

// Xóa ảnh khi nhấn nút "Xóa"
// Xóa ảnh khi nhấn nút "Xóa"
function deleteImage(element) {
    const imageGroup = element.closest('.image-group');
    const imageName = $(element).closest('.image-group').find('img').attr('src');
    const imageFileName = imageName ? imageName.split('/').pop() : null;

    // Thêm tên ảnh vào mảng nếu có tên ảnh và chưa tồn tại trong danh sách đã xóa
    if (imageFileName && !removedImages.includes(imageFileName)) {
        removedImages.push(imageFileName);
        document.getElementById('removedImages').value = JSON.stringify(removedImages);
    }

    // Xóa HTML của ảnh
    imageGroup.remove();
    console.log('Danh sách ảnh cần xóa:', removedImages);
}


// BIẾN THỂ
function createVariant() {
    let counts_variant = document.querySelectorAll('.variant-group').length - 1;
    counts_variant++;
    console.log("Số lượng biến thẻ  hiện tại:", counts_variant);
    $('#additional-variants').append(`
    <div class="variant-group row align-items-center m-1 p-1 border rounded">
        <div class="col-5">
            <input type="text" class="form-control" name="variant[${counts_variant}][nameVariant]" placeholder="Tên biến thể">
        </div>
        <div class="col-5">
            <input type="text" class="form-control" name="variant[${counts_variant}][priceVariant]" placeholder="Giá">
        </div>
        <div class="col-2 text-end">
            <a href="javascript:void(0)" class="btn btn-danger delete-image" onclick="deleteVariant(this)">
                <i class="bi bi-trash"></i> Xóa
            </a>
        </div>
    </div>
`);
}

function deleteVariant(__this) {
    let deleteVariant = document.querySelectorAll('.variant-group').length - 1;
    deleteVariant--;
    $(__this).closest('.variant-group').remove();
}