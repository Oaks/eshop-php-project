SELECT product.title AS Product, category.title AS Category FROM product
    JOIN category ON product.category_id =  category.id;
