<?php
$errors = $data['errors'];
$poll = $data['poll'];
$getCategory = $data['getCategory'];
$this->includeFile('front/layout/header');
?>
<div class="container">
    <h4 class="text-center">Add new poll</h4><hr>
    <div class="row">
        <div class="col-md-5">
            <form action="<?php echo BASE_URL; ?>/poll/store" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category">
                        <option value="">Select</option>
                        <?php foreach ($getCategory as $category) : ?>
                            <option value="<?php echo $category['id']; ?>"
                                <?php if ($category['id']==$poll['category']){ echo "selected";} ?>>
                                <?php echo $category['title']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="error">
                        <?php if(!empty($errors['categoryErr'])): echo $errors['categoryErr'];  endif; ?>
                    </span>
                </div>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter title" value="<?php if (!empty($poll['title'])){ echo $poll['title'];  } ?>">
                    <span class="error">
                        <?php if(!empty($errors['titleErr'])): echo $errors['titleErr'];  endif; ?>
                    </span>
                </div>
                <div class="form-group">
                    <label>Upload image</label>
                    <input type="file" class="form-control" name="image">
                    <span class="error">
                        <?php if(!empty($errors['imageErr'])): echo $errors['imageErr'];  endif; ?>
                    </span>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control"  rows="5" name="description">
                        <?php if (!empty($poll['description'])){ echo $poll['description'];  } ?>
                    </textarea>
                    <span class="error">
                        <?php if(!empty($errors['descriptionErr'])): echo $errors['descriptionErr'];  endif; ?>
                    </span>
                </div>
                <button type="submit" name="poll" class="btn btn-primary">Add</button>
                <button type="reset" class="btn btn-primary">Reset</button>
            </form><br><br><hr>
        </div>
    </div>
</div>
<?php $this->includeFile('front/layout/footer'); ?>
