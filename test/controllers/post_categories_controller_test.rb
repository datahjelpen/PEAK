require 'test_helper'

class PostCategoriesControllerTest < ActionDispatch::IntegrationTest
  setup do
    @post_category = post_categories(:one)
  end

  test "should get index" do
    get post_categories_url
    assert_response :success
  end

  test "should get new" do
    get new_post_category_url
    assert_response :success
  end

  test "should create post_category" do
    assert_difference('PostCategory.count') do
      post post_categories_url, params: { post_category: { image: @post_category.image, integer: @post_category.integer, integer: @post_category.integer, integer: @post_category.integer, integer: @post_category.integer, locale: @post_category.locale, name: @post_category.name, parent: @post_category.parent, rights: @post_category.rights, slug: @post_category.slug, string: @post_category.string, string: @post_category.string, string: @post_category.string, template: @post_category.template } }
    end

    assert_redirected_to post_category_url(PostCategory.last)
  end

  test "should show post_category" do
    get post_category_url(@post_category)
    assert_response :success
  end

  test "should get edit" do
    get edit_post_category_url(@post_category)
    assert_response :success
  end

  test "should update post_category" do
    patch post_category_url(@post_category), params: { post_category: { image: @post_category.image, integer: @post_category.integer, integer: @post_category.integer, integer: @post_category.integer, integer: @post_category.integer, locale: @post_category.locale, name: @post_category.name, parent: @post_category.parent, rights: @post_category.rights, slug: @post_category.slug, string: @post_category.string, string: @post_category.string, string: @post_category.string, template: @post_category.template } }
    assert_redirected_to post_category_url(@post_category)
  end

  test "should destroy post_category" do
    assert_difference('PostCategory.count', -1) do
      delete post_category_url(@post_category)
    end

    assert_redirected_to post_categories_url
  end
end
