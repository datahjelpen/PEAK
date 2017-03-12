require 'test_helper'

class PostCategoryLinksControllerTest < ActionDispatch::IntegrationTest
  setup do
    @post_category_link = post_category_links(:one)
  end

  test "should get index" do
    get post_category_links_url
    assert_response :success
  end

  test "should get new" do
    get new_post_category_link_url
    assert_response :success
  end

  test "should create post_category_link" do
    assert_difference('PostCategoryLink.count') do
      post post_category_links_url, params: { post_category_link: { category: @post_category_link.category, post: @post_category_link.post } }
    end

    assert_redirected_to post_category_link_url(PostCategoryLink.last)
  end

  test "should show post_category_link" do
    get post_category_link_url(@post_category_link)
    assert_response :success
  end

  test "should get edit" do
    get edit_post_category_link_url(@post_category_link)
    assert_response :success
  end

  test "should update post_category_link" do
    patch post_category_link_url(@post_category_link), params: { post_category_link: { category: @post_category_link.category, post: @post_category_link.post } }
    assert_redirected_to post_category_link_url(@post_category_link)
  end

  test "should destroy post_category_link" do
    assert_difference('PostCategoryLink.count', -1) do
      delete post_category_link_url(@post_category_link)
    end

    assert_redirected_to post_category_links_url
  end
end
