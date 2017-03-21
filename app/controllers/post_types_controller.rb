class PostTypesController < ApplicationController
  def show
    @postType = PostType.find(params[:id])
  end
end
