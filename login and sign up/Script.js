
const products = {
    "products": [
        {
            "name": "Kabras Sugar 2kg",
            "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            "price": {
                "Naivas": 419,
                "Carrefour": 427,
                "Chandarana": 410,
                "Quickmart": 425,
                "Onn the Way": 425,
                "Jumia": 435
            }
        },
        {
            "name": "Jogoo 2kg",
            "description": "Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            "price": {
                "Naivas": 235,
                "Carrefour": 221,
                "Chandarana": 230,
                "Quickmart": 235,
                "Onn the Way": 225,
                "Jumia": 250
            }
        },
        {
            "name": "Ndovu Maize Meal 2kg",
            "description": "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            "price": {
                "Naivas": 218,
                "Carrefour": 220,
                "Chandarana": 'NA',
                "Quickmart": 215,
                "Onn the Way": 225,
                "Jumia": 230
            }
        },
        {
            "name": "Soko Meal 2kg",
            "description": "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            "price": {
                "Naivas": 250,
                "Carrefour": 215,
                "Chandarana": 240,
                "Quickmart": 235,
                "Onn the Way": 225,
                "Jumia": 230
            }
        },
        {
            "name": "Pembe Maize Meal 2kg",
            "description": "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            "price": {
                "Naivas": 227,
                "Carrefour": 215,
                "Chandarana": 235,
                "Quickmart": 225,
                "Onn the Way": 215,
                "Jumia": 230
            }
        },
        {
            "name": "Ajab Maize Meal 2kg",
            "description": "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            "price": {
                "Naivas": 227,
                "Carrefour": 192,
                "Chandarana": 235,
                "Quickmart": 225,
                "Onn the Way": 215,
                "Jumia": 230
            }
        },
        {
            "name": "Amaize Maize Meal 2kg",
            "description": "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            "price": {
                "Naivas": 227,
                "Carrefour": 244,
                "Chandarana": 235,
                "Quickmart": 225,
                "Onn the Way": 215,
                "Jumia": 230
            }
        },
        {
            "name": "Jogoo 1kg",
            "description": "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            "price": {
                "Naivas": 109,
                "Carrefour": 110,
                "Chandarana": 105,
                "Quickmart": 117,
                "Onn the Way": 105,
                "Jumia": 112
            }
        }
    ]
};


const form = document.getElementById('search-form');
const productList = document.getElementById('product-list');
const cartItemsList = document.getElementById('cart-items');

form.addEventListener('submit', function(e) {
  e.preventDefault();
  const searchValue = document.getElementById('search-input').value.toLowerCase();
  const filteredProducts = products.products.filter(function(product) {
    return product.name.toLowerCase().includes(searchValue);
  });
  displayProducts(filteredProducts);
});

function displayProducts(products) {
  let html = '<table>';
  html += '<tr>';
  html += '<th>Product</th>';
  html += '<th>Quantity</th>';
  for (const store in products[0].price) {
    html += `<th>${store}</th>`;
  }
  html += '<th>Add to Cart</th>';
  html += '</tr>';
  
  products.forEach(function(product) {
    html += '<tr>';
    html += `<td>${product.name}</td>`;
    html += `<td><input type="number" class="quantity-input" id="quantity-${product.name}" min="1" value="1" oninput="updatePrice('${product.name}', this.value)"></td>`;

    for (const store in product.price) {
      html += `<td class="price-${product.name}-${store}">${product.price[store]}</td>`;
    }
    html += `<td><button class="add-to-cart-btn" onclick="addToCart('${product.name}')">Add to Cart</button></td>`;
    html += '</tr>';
  });

  html += '</table>';
  productList.innerHTML = html;
}

const cart = {
  items: [],

  addItem: function(productName, quantity) {
    const product = products.products.find(function(p) {
      return p.name === productName;
    });
    const cartItem = {
      product: product,
      quantity: quantity
    };
    this.items.push(cartItem);
    this.updateCart();
  },

  removeItem: function(index) {
    this.items.splice(index, 1);
    this.updateCart();
  },

  updateCart: function() {
    let html = '<table>';
    html += '<tr>';
    html += '<th>Product</th>';
    for (const store in products.products[0].price) {
      html += `<th>${store}</th>`;
    }
    html += '<th>Quantity</th>';
    html += '<th>Add to Cart</th>';
    html += '</tr>';
    
    let grandTotal = 0;
    let totalQuantity = 0;

    this.items.forEach(function(item, index) {
      const product = item.product;
      const quantity = item.quantity;
      const totalProductPrice = calculateTotalProductPrice(product, quantity);
      const storePrices = product.price;

      html += '<tr>';
      html += `<td>${product.name}</td>`;

      for (const store in storePrices) {
        html += `<td>${storePrices[store]}</td>`;
      }
      html += `<td>${quantity}</td>`;
      html += `<td><button class="remove-from-cart-btn" onclick="removeFromCart(${index})">Remove</button></td>`;
      html += '</tr>';

      totalQuantity += quantity;
    });

    html += '<tr>';
    html += '<td colspan="1">Totals</td>';

    for (const store in products.products[0].price) {
      let storeTotal = 0;

      this.items.forEach(function(item) {
        const product = item.product;
        const quantity = item.quantity;

        storeTotal += calculateTotalProductPrice(product, quantity, store);
      });

      html += `<td>${storeTotal.toFixed(2)}</td>`;
    }
    html += `<td> ${totalQuantity}</td>`;
    html += '</tr>';

    html += '</table>';
    cartItemsList.innerHTML = html;
  }
};

function calculateTotalProductPrice(product, quantity, store) {
  let totalPrice = 0;

  if (store) {
    totalPrice = product.price[store] * quantity;
  } else {
    for (const store in product.price) {
      totalPrice += product.price[store] * quantity;
    }
  }

  return totalPrice;
}

function addToCart(productName) {
  const quantityInput = document.getElementById(`quantity-${productName}`);
  const quantity = parseInt(quantityInput.value);
  cart.addItem(productName, quantity);
}

function removeFromCart(index) {
  cart.removeItem(index);
}

function updatePrice(productName, quantity) {
  const cartItemIndex = cart.items.findIndex(function(item) {
    return item.product.name === productName;
  });

  if (cartItemIndex !== -1) {
    const cartItem = cart.items[cartItemIndex];
    cartItem.quantity = parseInt(quantity);

    cart.updateCart();
  }
}

