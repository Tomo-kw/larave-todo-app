<div class="mb-3">
    <label class="form-label" for="user_id">ユーザー</label>
    <select id="user_id" name="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
        <option value="">選択してください</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ old('user_id', $todo->user_id ?? '') == $user->id ? 'selected' : '' }}>
                {{ $user->name }} ({{ $user->email }})
            </option>
        @endforeach
    </select>
    @error('user_id')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="title">タイトル</label>
    <input id="title" name="title" value="{{ old('title', $todo->title ?? '') }}" class="form-control @error('title') is-invalid @enderror" required>
    @error('title')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="content">内容</label>
    <textarea id="content" name="content" rows="4" class="form-control @error('content') is-invalid @enderror">{{ old('content', $todo->content ?? '') }}</textarea>
    @error('content')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label" for="status">状態</label>
        <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
            @php
                $statuses = ['pending' => '保留', 'in_progress' => '進行中', 'done' => '完了'];
            @endphp
            @foreach($statuses as $key => $label)
                <option value="{{ $key }}" {{ old('status', $todo->status ?? 'pending') === $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label" for="priority">優先度</label>
        <input id="priority" name="priority" type="number" min="1" max="5" value="{{ old('priority', $todo->priority ?? 3) }}" class="form-control @error('priority') is-invalid @enderror" required>
        @error('priority')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label" for="due_date">期限</label>
        <input id="due_date" name="due_date" type="date" value="{{ old('due_date', optional($todo->due_date)->format('Y-m-d')) }}" class="form-control @error('due_date') is-invalid @enderror">
        @error('due_date')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
