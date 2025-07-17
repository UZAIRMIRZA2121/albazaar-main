"use strict";

const slider = document.getElementById("price-slider");
const minInput = document.getElementById("min_price");
const maxInput = document.getElementById("max_price");
const minDisplay = document.getElementById("price-min-display");
const maxDisplay = document.getElementById("price-max-display");

// Update range slider & display when inputs change
minInput.addEventListener("input", () => {
    const val = Math.min(
        parseInt(minInput.value) || 13,
        parseInt(maxInput.value) || 36
    );
    slider.min = val;
    slider.value = val;
    minDisplay.textContent = `$${val.toFixed(2)}`;
});

maxInput.addEventListener("input", () => {
    const val = Math.max(
        parseInt(maxInput.value) || 36,
        parseInt(minInput.value) || 13
    );
    slider.max = val;
    maxDisplay.textContent = `$${val.toFixed(2)}`;
});

// Update inputs when slider moves
slider.addEventListener("input", () => {
    minInput.value = slider.value;
    minDisplay.textContent = `$${slider.value}`;
});

let productListPageBackup = $("#products-search-data-backup");
let productListPageData = {
    id: productListPageBackup.data("id"),
    name: productListPageBackup.data("name"),
    brand_id: productListPageBackup.data("brand"),
    category_id: productListPageBackup.data("category"),
    data_from: productListPageBackup.data("from"),
    min_price: productListPageBackup.data("min-price"),
    max_price: productListPageBackup.data("max-price"),
    sort_by: productListPageBackup.data("sort_by"),
    product_type: productListPageBackup.data("product-type"),
    vendor_id: productListPageBackup.data("vendor-id"),
    author_id: productListPageBackup.data("author-id"),
    publishing_house_id: productListPageBackup.data("publishing-house-id"),
};

function getProductListFilterRender() {
    const baseUrl = productListPageBackup.data("url");
    const queryParams = $.param(productListPageData);
    const newUrl = baseUrl + "?" + queryParams;
    history.pushState(null, null, newUrl);

    $.get({
        url: productListPageBackup.data("url"),
        data: productListPageData,
        dataType: "json",
        beforeSend: function () {
            $("#loading").show();
        },
        success: function (response) {
            $("#ajax-products").html(response.view);
            $(".view-page-item-count").html(response.total_product);

            // Run function with error check
            try {
                // Update the URL and reload the page
                window.location.href = newUrl;
            } catch (e) {
                console.error("renderQuickViewFunction error:", e);
            }
        },
        complete: function () {
            $("#loading").hide();
        },
    });
}

$(".product-list-filter-on-viewpage").on("change", function () {
    productListPageData.sort_by = $(this).val();
    getProductListFilterRender();
});

$(".filter-on-product-filter-change").on("change", function () {
    productListPageData.data_from = $(this).val();
    getProductListFilterRender();
});

$(".filter-on-product-type-change").on("change", function () {
    productListPageData.product_type = $(this).val();
    productListPageData.data_from = $(".filter-on-product-filter-change").val();
    $(".current-product-type").html(
        $(".current-product-type").data($(this).val())
    );
    listPageProductTypeCheck();
    getProductListFilterRender();
});

function listPageProductTypeCheck() {
    if (productListPageData?.product_type.toString() === "digital") {
        $(".product-type-digital-section").show();
        $(".product-type-physical-section").hide();
    } else if (productListPageData?.product_type.toString() === "physical") {
        $(".product-type-digital-section").hide();
        $(".product-type-physical-section").show();
    } else {
        $(".product-type-physical-section").show();
        $(".product-type-digital-section").show();
    }
}
listPageProductTypeCheck();

$("#min_price").on("change", function () {
    productListPageData.min_price = $(this).val();
    getProductListFilterRender();
});

$("#max_price").on("change", function () {
    productListPageData.max_price = $(this).val();
    getProductListFilterRender();
});

$(".action-search-products-by-price").on("click", function () {
    productListPageData.min_price = $("#min_price").val();
    productListPageData.max_price = $("#max_price").val();
    getProductListFilterRender();
});
$("#min_price, #max_price").on("blur", function () {
    productListPageData.min_price = $("#min_price").val();
    productListPageData.max_price = $("#max_price").val();
    getProductListFilterRender();
});


$("#searchByFilterValue-m").change(function () {
    productListPageData.data_from = $(this).val();
    getProductListFilterRender();
});

$("#search-brand").on("keyup", function () {
    let value = this.value.toLowerCase().trim();
    $("#lista1 div>li")
        .show()
        .filter(function () {
            return $(this).text().toLowerCase().trim().indexOf(value) == -1;
        })
        .hide();
});

$(".search-product-attribute").on("keyup", function () {
    let value = this.value.toLowerCase().trim();
    $(this)
        .closest(".search-product-attribute-container")
        .find(".attribute-list ul>li")
        .show()
        .filter(function () {
            return $(this).text().toLowerCase().trim().indexOf(value) == -1;
        })
        .hide();
});
