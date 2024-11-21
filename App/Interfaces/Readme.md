- interface là một lớp trừu tượng , chỉ chứa các khai báo của phương thức, không chứa bất kỳ logic cụ thể nào. { Điều này có nghĩa là tất cả các phương thức trong interface đều là phương thức trừu tượng (abstract), và chúng không có phần thân phương thức (không có code bên trong).}

- implements là  sử dụng để một lớp kế thừa từ một hoặc nhiều interfaces. Khi một lớp implements một interface, lớp đó phải định nghĩa (triển khai) tất cả các phương thức được khai báo trong interface đó.
----------------------------------------------------------------------------------------------------
- Lớp Trừu Tượng (abstract):được sử dụng để khai báo các lớp trừu tượng hoặc các phương thức trừu tượng.

- Kế Thừa (extends): nó chỉ ra  lớp con đang kế thừa thuộc tính và phương thức từ lớp cha, đồng thời có thể ghi đè hoặc bổ sung các phương thức và thuộc tính cần thiết cho các yêu cầu cụ thể.
----------------------------------------------------------------------------------------------------
 foreach ($data as $item): là foreach nó sẽ lặp qua từng phần tử trong $dâta sau đó gán các phần tử cho item cho đến khi hết phần tử

$data: Mảng muốn lặp qua.
$item:  sẽ nhận giá trị của một phần tử trong mảng $data trong mỗi vòng lặp.

foreach sẽ chuyển sang phần tử tiếp theo cho đến khi tất cả các phần tử trong mảng được xử lý.

------------------------------------------
protected là để tạo ra các thành phần có thể được sử dụng  trong các lớp.  tạo ra một cơ chế kế thừa và tái sử dụng code hiệu quả.