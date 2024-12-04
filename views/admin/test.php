<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Gallery</title>
    <style>
.product-slideshow {
  position: relative;
  width: 80%;
  max-width: 600px;
  margin: 0 auto;
}

.slideshow-container {
  position: relative;
  display: flex;
  overflow: hidden;
}

.slide {
  display: none; /* Ẩn tất cả ảnh */
  width: 100%;
  position: relative;
  /* Cố định tỷ lệ khung hình bằng cách sử dụng padding-bottom */
  padding-bottom: 56.25%; /* Tỷ lệ 16:9 (9/16 = 0.5625 => 56.25%) */
}

.slide img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover; /* Đảm bảo ảnh không bị biến dạng và phủ đầy khung */
}

.caption {
  position: absolute;
  bottom: 20px;
  left: 50%;
  transform: translateX(-50%);
  background-color: rgba(0, 0, 0, 0.5);
  color: white;
  font-size: 18px;
  padding: 10px;
  border-radius: 5px;
}

/* Hiển thị ảnh hiện tại */
.active {
  display: block;
}

button {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background-color: rgba(0, 0, 0, 0.5);
  color: white;
  font-size: 24px;
  padding: 10px;
  border: none;
  cursor: pointer;
  z-index: 100;
}

.prev {
  left: 0;
}

.next {
  right: 0;
}

button:hover {
  background-color: rgba(0, 0, 0, 0.8);
}


    </style>
</head>
<body>
<div class="product-slideshow">
  <button class="prev">❮</button>
  
  <div class="slideshow-container">
    <?php foreach ($banners as $banner): ?>
      <div class="slide">
        <img src="<?php echo $banner->product_img; ?>" alt="">
        <div class="caption"><?php echo $banner->price; ?></div>
      </div>
    <?php endforeach; ?>
  </div>
  
  <button class="next">❯</button>
</div>
</body>
</html>

<<script>
document.addEventListener('DOMContentLoaded', function() {
  let currentIndex = 0;
  const slides = document.querySelectorAll('.slide');
  const totalSlides = slides.length;

  function showSlide(index) {
    slides.forEach((slide) => {
      slide.classList.remove('active');
    });

    slides[index].classList.add('active');
  }

  function nextSlide() {
    currentIndex = (currentIndex + 1) % totalSlides; // Chuyển sang ảnh tiếp theo
    showSlide(currentIndex);
  }

  function prevSlide() {
    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides; // Quay lại ảnh trước
    showSlide(currentIndex);
  }

  // Hiển thị slide đầu tiên
  showSlide(currentIndex);

  // Chuyển ảnh tự động mỗi 3 giây
  setInterval(nextSlide, 3000);

  // Xử lý sự kiện cho các nút
  document.querySelector('.next').addEventListener('click', nextSlide);
  document.querySelector('.prev').addEventListener('click', prevSlide);
});


</script>